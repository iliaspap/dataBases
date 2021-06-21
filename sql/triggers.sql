-- When a Customer registers for a service give them access to all spaces that offer it.
-- When they register for the Room Stay service (id 7) give them access to all spaces that dont require registration.
create trigger grantAccess after insert on Registers
    for each row

    insert into HasAccess(nfc_id, start_datetime, space_id)
    (select distinct NEW.nfc_id, NEW.registration_datetime, o.space_id
    from Offers as o
    where NEW.service_id = o.service_id and NEW.service_id <> 7)
    union
    (select distinct NEW.nfc_id, NEW.registration_datetime, o.space_id
    from Offers as o, Service as s
    where o.service_id = s.service_id and s.needs_registration = 0
            and NEW.service_id = 7);

-- When a customer unregisters from a service remove access to all the spaces that offer it.
-- To do this we set the end datetime of HasAccess to the datetime of unregistration (access ends).
create trigger endAccess before delete on Registers 
    for each row
    update HasAccess
    set HasAccess.end_datetime = now()
    where HasAccess.nfc_id = OLD.nfc_id and HasAccess.end_datetime is null
    and HasAccess.space_id in (select distinct Offers.space_id 
                               from Offers 
                               where Offers.service_id = OLD.service_id);

-- When a service is no longer offered, delete all access to its spaces.
create trigger endOffer before delete on Offers
    for each row
    update HasAccess
    set HasAccess.end_datetime = now()
    where HasAccess.space_id = OLD.space_id and HasAccess.end_datetime is null;

-- When a service stops existing, delete all access to its spaces.
create trigger endService before delete on Service
    for each row
    update HasAccess
    set HasAccess.end_datetime = now()
    where HasAccess.end_datetime is null
    and HasAccess.space_id in (select distinct Offers.space_id 
                               from Offers 
                               where Offers.service_id = OLD.service_id);
