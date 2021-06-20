drop trigger if exists grantAccess;

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
    

drop trigger if exists endAccess;

create trigger endAccess after delete on Registers
    for each row
    update HasAccess
    set end_datetime = now()
    where space_id in  (select distinct space_id 
                        from Offers 
                        where Offers.service_id = service_id);
