-- most visited spaces
SELECT S.name, count(V.space_id) as num
FROM Space as S
JOIN Visits as V ON V.space_id = S.space_id
JOIN Customer as C ON V.nfc_id = C.nfc_id
                    and V.arrival_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
                    and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN 20 AND 40
GROUP BY V.space_id
ORDER BY num DESC;

-- most used services
SELECT S.service_description, count(C.nfc_id) as num
FROM Service as S
JOIN Service_charge as Sc ON S.service_id = Sc.service_id
JOIN Customer as C ON C.nfc_id = Sc.nfc_id
                     and Sc.service_charge_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
                     and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN 20 AND 40
GROUP BY S.service_description
ORDER BY num DESC;

-- services used by most customers
SELECT S.service_description, count(distinct C.nfc_id) as num
FROM Service as S
JOIN Service_charge as Sc ON S.service_id = Sc.service_id
JOIN Customer as C ON C.nfc_id = Sc.nfc_id
                     and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN 20 AND 40
                     and Sc.service_charge_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
GROUP BY S.service_description
ORDER BY num DESC;
