SELECT
    u.Cedula,
    u.Contrasena,
    u.Estado,

    CASE
        WHEN d.Cedula IS NOT NULL THEN 1
        ELSE 0
    END AS docente,

    CASE
        WHEN a.Cedula IS NOT NULL THEN 1
        ELSE 0
    END AS administrativo,

    CASE
        WHEN t.Cedula IS NOT NULL THEN 1
        ELSE 0
    END AS tecnico,

    CASE
        WHEN dir.Cedula IS NOT NULL THEN 1
        ELSE 0
    END AS direccion,

    CASE
        WHEN e.Cedula IS NOT NULL THEN 1
        ELSE 0
    END AS estudiante

FROM USUARIO AS u
    LEFT JOIN DOCENTE AS d ON d.Cedula = u.Cedula
    LEFT JOIN ADMINISTRATIVO AS a ON a.Cedula = u.Cedula
    LEFT JOIN TECNICO AS t ON t.Cedula = u.Cedula
    LEFT JOIN DIRECCION AS dir ON dir.Cedula = u.Cedula
    LEFT JOIN ESTUDIANTE AS e ON e.Cedula = u.Cedula

WHERE u.Cedula = ?;