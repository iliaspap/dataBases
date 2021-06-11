drop view if exists service_usage;

create view service_usage as
select s.service_id, s.service_description, c.surname, c.name, sc.service_charge_datetime, sc.description, sc.amount
from Service_charge as sc
join Service as s on sc.service_id = s.service_id
join Customer as c on sc.nfc_id = c.nfc_id
order by sc.service_charge_datetime desc;

drop view if exists customer_data;

create view customer_data as
select c.nfc_id, c.surname, c.name, c.date_of_birth, c.id_document_number, c.id_document_type, c.id_document_authority, p.phone, e.email
from Customer as c
left join instPhone as p on c.nfc_id = p.nfc_id
left join instEmail as e on c.nfc_id = e.nfc_id
order by c.nfc_id asc;

drop view if exists category_charges;

create view category_charges as
select service_description,  round(sum(amount), 2) as amount, count(service_id) as num
from service_usage
group by service_id
order by sum(amount) desc;
