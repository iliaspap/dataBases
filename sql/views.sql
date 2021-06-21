drop view if exists service_usage;

-- A view that contains all transactions and the customer and service that they involve.
create view service_usage as
select s.service_id, s.service_description, c.surname, c.name, sc.service_charge_datetime, sc.description, sc.amount
from Service_charge as sc
join Service as s on sc.service_id = s.service_id
join Customer as c on sc.nfc_id = c.nfc_id
order by sc.service_charge_datetime desc;

drop view if exists customer_data;

-- A view that contains all customers, their data and two phone numbers and emails for each one (if they have).
create view customer_data as
select c.nfc_id, c.surname, c.name, c.date_of_birth, c.id_document_number, c.id_document_type, c.id_document_authority, p1.phone as phone1, p2.phone as phone2, e1.email as email1, e2.email as email2
from Customer as c
left join instPhone as p1 on c.nfc_id = p1.nfc_id
left join instPhone as p2 on c.nfc_id = p2.nfc_id and p1.phone <> p2.phone
left join instEmail as e1 on c.nfc_id = e1.nfc_id 
left join instEmail as e2 on c.nfc_id = e2.nfc_id and e1.email <> e2.email
group by c.nfc_id;

drop view if exists category_charges;

-- A view that contains the number of transactions and total amount of numbers for each service category.
create view category_charges as
select service_description,  round(sum(amount), 2) as amount, count(service_id) as num
from service_usage
group by service_id
order by sum(amount) desc;
