CL SCR;
SET SERVEROUTPUT ON;

CREATE OR REPLACE TRIGGER RN_01_SOLAPAMIENTO_PROYECTOS
BEFORE INSERT OR UPDATE ON proyectos
FOR EACH ROW
DECLARE
    enc NUMBER(1);
    CURSOR l_proyectos IS
        SELECT id FROM proyectos WHERE
        :NEW.id_cliente = id_cliente AND
        :NEW.fecha_inicio >= fecha_inicio AND
        fecha_final IS NOT NULL AND
        :NEW.fecha_inicio <= fecha_final;
        
    v_proyecto l_proyectos%ROWTYPE;
BEGIN
    OPEN l_proyectos;
    LOOP
        FETCH l_proyectos INTO v_proyecto;
        EXIT WHEN l_proyectos%NOTFOUND;
        IF enc = 0 THEN
            enc := 1;
        ELSE
            raise_application_error(-20600,'Un cliente no puede organizar más de un evento a la vez');
        END IF;
    END LOOP;
    CLOSE l_proyectos;
END;
/

CREATE OR REPLACE TRIGGER RN_02_SOLAPAMIENTO_EVENTOS
BEFORE INSERT OR UPDATE ON eventos
FOR EACH ROW
DECLARE
    fecha_inicio DATE;
    fecha_final DATE;
    CURSOR l_eventos IS
        SELECT fecha_inicio, fecha_final FROM eventos WHERE
        :NEW.id_proyecto = id_proyecto;
        
    v_evento l_eventos%ROWTYPE;
BEGIN
    OPEN l_eventos;
    LOOP
        FETCH l_eventos INTO v_evento;
        EXIT WHEN l_eventos%NOTFOUND;
        
        fecha_inicio := v_evento.fecha_inicio;
        fecha_final := v_evento.fecha_final;
        
        IF (:NEW.fecha_inicio > fecha_inicio AND :NEW.fecha_inicio < fecha_final) OR
            (:NEW.fecha_final > fecha_inicio AND :NEW.fecha_final < fecha_final) THEN
            raise_application_error(-20600,'Un cliente no puede organizar más de un evento a la vez');
        END IF;
    END LOOP;
    CLOSE l_eventos;
END;
/
