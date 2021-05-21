create table Customer (
  nfc_id int auto_increment,
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
  phone int,

  primary key (nfc_id, phone),
  foreign key (nfc_id) references Customer
);

create table instEmail (
  nfc_id int,
  email varchar(31),

  primary key (nfc_id, email),
  foreign key (nfc_id) references Customer
);

create table Service (
  service_id int auto_increment,
  service_descritption varchar(100),
  needs_registation bit(1) not null, -- sigoura?

  primary key (service_id)
);

create table Space (
  space_id int auto_increment,
  number_of_beds int,
  name varchar(31),
  description_location varchar(100),

  primary key (space_id)
);

create table Visits (
  nfc_id int,
  arrival_datetime datetime,
  space_id int,
  exit_datetime datetime,

  primary key (nfc_id, arrival_datetime),
  foreign key (nfc_id) references Customer,
  foreign key (space_id) references Space
);

create table Service_charge (
  nfc_id int,
  service_id int,
  service_charge_datetime datetime,
  description varchar(100),
  amount int,

  primary key (nfc_id, service_id, service_charge_datetime),
  foreign key (nfc_id) references Customer,
  foreign key (service_id) references Service
);

create table registers (
  nfc_id int,
  service_id int,
  registration_datetime datetime, --??

  primary key (nfc_id, service_id),
  foreign key (nfc_id) references Customer
);

create table HasAccess (
  nfc_id int,
  start_datetime datetime,
  end_datetime datetime,
  space_id int,

  primary key (nfc_id,start_datetime),
  foreign key (nfc_id) references Customer
);

create table Offers(
  space_id int,
  service_id int,

  primary key (space_id, service_id),
  foreign key (space_id) references Space,
  foreign key (service_id) references Service
);
