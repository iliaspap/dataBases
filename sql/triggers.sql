drop trigger if exists grantAccess;

create trigger grantAccess after insert on Registers
    for each row
    insert into HasAccess(nfc_id, start_datetime, space_id)
    select distinct r.nfc_id, r.registration_datetime, o.space_id
    from Registers as r, Offers as o
    where r.service_id = NEW.service_id and r.nfc_id = NEW.nfc_id 
        and r.service_id = o.service_id and NEW.service_id <> 7;

drop trigger if exists endAccess;

create trigger endAccess after delete on Registers
    for each row
    update HasAccess
    set end_datetime = now()
    where space_id in  (select distinct space_id 
                        from Offers 
                        where Offers.service_id = service_id);


