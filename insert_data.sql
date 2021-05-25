load data local infile '/home/marios/ECE/databases/project/customers.csv' into table Customer 
fields terminated by ',' 
lines terminated by '\n'
ignore 1 rows 
(name,surname,@date_of_birth,id_document_number,id_document_type,id_document_authority)
set date_of_birth = str_to_date(@date_of_birth, '%yyyy-%mm-%dd');

