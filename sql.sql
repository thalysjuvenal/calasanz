SELECT
    *
FROM
    membros
where
    igreja = '1'
    and month(data_nasc) = '10'
    and day(data_nasc) = '31'
order by
    data_nasc asc