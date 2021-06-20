--usage of all services with multiple criteria (question 7a)
SELECT * FROM service_usage WHERE service_charge_datetime >= ? and service_charge_datetime <= ? and amount >= ? and amount <= ?
ORDER BY service_charge_datetime;

--usage of specified service with multiple criteria (question 7b)
SELECT * FROM service_usage WHERE service_description = ? and service_charge_datetime >= ? and
service_charge_datetime <= ? and amount >= ? and amount <= ?
ORDER BY service_charge_datetime;

--charges grouped by category, selects the whole view (first part of question 8)
SELECT * FROM category_charges

--selects the visits of an infected customer (question 9)
SELECT s.space_id, s.name, s.description_location, v.arrival_datetime, v.exit_datetime FROM Visits as v JOIN Space as s ON v.space_id = s.space_id WHERE v.nfc_id = ?

--finds the customers that might be infected by the infected customer (question 10)
SELECT DISTINCT c.nfc_id, c.name, c.surname, c.date_of_birth, c.id_document_number, c.id_document_type, c.id_document_authority
       FROM Customer as c, Visits as v1, Visits as v2
       WHERE v1.nfc_id= ? AND c.nfc_id=v2.nfc_id AND v1.nfc_id<>v2.nfc_id AND v1.space_id=v2.space_id AND ! ( v2.exit_datetime < v1.arrival_datetime OR v2.arrival_datetime > DATE_ADD(v1.exit_datetime, INTERVAL 1 HOUR) )

-- most visited spaces (question 11)
SELECT S.name, count(V.space_id) as num
FROM Space as S
JOIN Visits as V ON V.space_id = S.space_id
JOIN Customer as C ON V.nfc_id = C.nfc_id
                    and V.arrival_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
                    and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN 20 AND 40
GROUP BY V.space_id
ORDER BY num DESC;

-- most used services (question 11)
SELECT S.service_description, count(C.nfc_id) as num
FROM Service as S
JOIN Service_charge as Sc ON S.service_id = Sc.service_id
JOIN Customer as C ON C.nfc_id = Sc.nfc_id
                     and Sc.service_charge_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
                     and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN 20 AND 40
GROUP BY S.service_description
ORDER BY num DESC;

-- services used by most customers (question 11)
SELECT S.service_description, count(distinct C.nfc_id) as num
FROM Service as S
JOIN Service_charge as Sc ON S.service_id = Sc.service_id
JOIN Customer as C ON C.nfc_id = Sc.nfc_id
                     and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN 20 AND 40
                     and Sc.service_charge_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
GROUP BY S.service_description
ORDER BY num DESC;
