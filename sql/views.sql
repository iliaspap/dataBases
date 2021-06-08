-- question 7
-- change attribute names?
create view service_usage as
select s.service_description, c.surname, c.name, sc.service_charge_datetime, sc.description, sc.amount
from Service_charge as sc
join Service as s on sc.service_id = s.service_id
join Customer as c on sc.nfc_id = c.nfc_id
order by sc.service_charge_datetime desc
