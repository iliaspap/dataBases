create index idx_birthdate
on Customer (date_of_birth);

create index idx_amount
on Service_charge (amount);

create index idx_space_id
on Visits (space_id);
