drop trigger if exists grantAccess;

create trigger grantAccess after insert on Registers
    for each row
    insert into HasAccess(nfc_id, start_datetime, space_id)
    select distinct r.nfc_id, r.registration_datetime, of.space_id
    from Registers as r, Offers as of
    where r.service_id = NEW.service_id and r.nfc_id = NEW.nfc_id and r.service_id = of.service_id and NEW.service_id <> 7;
