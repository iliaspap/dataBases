#!/usr/bin/env python

import mysql.connector
import csv

print("Getting things ready, please wait...")

# Connecting to mysql
print("Connecting to mysql...", end="")
mydb = mysql.connector.connect(
        user     = "asdf_admin",
        passwd   = "databases2021",
        )
print("Done")

mycursor = mydb.cursor()

def execute_script(file_name):
    script = open(file_name)
    sql_commands = script.read().split(';')[:-1]
    for c in sql_commands:
        mycursor.execute(c)

# Create Database
print("Creating database...", end="")
execute_script("./sql/hotel.sql")
print("Done")

# Create Triggers
print("Create triggers...", end="")
execute_script("./sql/triggers.sql")
print("Done")

# Create Views
print("Create views...", end="")
execute_script("./sql/views.sql")
print("Done")

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
    print("Inserting table: ", table, "...", end="", sep="")
    insertTable(table)
    print("Done")

# Close connection
print("Closing connection to mysql...", end="")
mycursor.close()
mydb.close()
print("Done")

print("Done!")
