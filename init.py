#!/usr/bin/env python

import mysql.connector
import csv

mydb = mysql.connector.connect(
        user     = "asdf_admin",
        passwd   = "databases2021",
        )

mycursor = mydb.cursor()

# Create Database
script = open("./sql/hotel.sql")
sql_commands = script.read().replace(('\n'), '').split(';')[:-1]
for c in sql_commands:
    mycursor.execute(c)

# Create Triggers
script = open("./sql/triggers.sql")
sql_commands = script.read().replace(('\n'), '').split(';')[:-1]
for c in sql_commands:
    mycursor.execute(c)


# Create Views
script = open("./sql/views.sql")
sql_commands = script.read().replace(('\n'), '').split(';')[:-1]
for c in sql_commands:
    mycursor.execute(c)


# Insert Data
def insertTable(tablename):
    with open(f'./csv/{tablename}.csv', 'r') as csv_file:
        csv_reader = csv.DictReader(csv_file)

        table = [line for line in csv_reader]
        for record in table:
            query = """INSERT INTO {} ({}) VALUES ({})""".format(tablename, ",".join(record.keys()), ",".join(f'"{word}"' for word in record.values()))
            mycursor.execute(query)
            mydb.commit()
            
for table in ["Customer", "instPhone", "instEmail", 
              "Service", "Space", "Offers", 
              "Registers", "Visits", "Service_charge"]:
    print("Inserting table: ", table, "...", end="")
    insertTable(table)
    print("Done")
