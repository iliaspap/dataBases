drop database if exists asdf_palace;
create database asdf_palace;

use asdf_palace;

create table Customer (
  nfc_id int,
  name varchar(31) not null,
  surname varchar(31) not null,
  date_of_birth date,
  id_document_number varchar(20),
  id_document_type varchar(31),
  id_document_authority varchar(31),

  primary key (nfc_id)
);

create table instPhone (
  nfc_id int,
  phone varchar(20),

  primary key (nfc_id, phone),
  foreign key (nfc_id) references Customer(nfc_id)
      on delete cascade on update cascade
);

create table instEmail (
  nfc_id int,
  email varchar(31),

  primary key (nfc_id, email),
  foreign key (nfc_id) references Customer(nfc_id)
      on delete cascade
      on update cascade
);

create table Service (
  service_id int,
  service_description varchar(100),
  needs_registration varchar(1) not null,

  primary key (service_id)
);

create table Space (
  space_id int,
  number_of_beds int,
  name varchar(31),
  description_location varchar(100),

  primary key (space_id)
);

create table Offers(
  space_id int,
  service_id int,

  primary key (space_id, service_id),
  foreign key (space_id) references Space(space_id)
      on delete cascade
      on update cascade,
  foreign key (service_id) references Service(service_id)
      on delete cascade
      on update cascade
);

create table Registers (
  nfc_id int,
  service_id int,
  registration_datetime datetime,

  primary key (nfc_id, service_id),
  foreign key (nfc_id) references Customer(nfc_id)
      on delete cascade
      on update cascade,
  foreign key (service_id) references Service(service_id)
      on delete cascade
      on update cascade
);

create table HasAccess (
  nfc_id int,
  start_datetime datetime,
  end_datetime datetime,
  space_id int,

  primary key (nfc_id, space_id, start_datetime),
  foreign key (nfc_id) references Customer(nfc_id)
      on delete cascade
      on update cascade,
  foreign key (space_id) references Space(space_id)
      on delete cascade
      on update cascade
);

create table Visits (
  nfc_id int,
  space_id int not null,
  arrival_datetime datetime,
  exit_datetime datetime,

  primary key (nfc_id, arrival_datetime),
  foreign key (nfc_id) references Customer(nfc_id)
      on delete cascade
      on update cascade,
  foreign key (space_id) references Space(space_id)
      on delete cascade
      on update cascade
);

create table Service_charge (
  nfc_id int,
  service_id int not null,
  service_charge_datetime datetime,
  description varchar(100),
  amount float,

  primary key (nfc_id, service_charge_datetime),
  foreign key (nfc_id) references Customer(nfc_id)
      on delete cascade
      on update cascade,
  foreign key (service_id) references Service(service_id)
      on delete cascade
      on update cascade
);
