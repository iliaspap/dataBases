import mysql.connector
import csv

mydb = mysql.connector.connect(
    user = "root",
    passwd = "",
    database = "Hotel"
)

mycursor = mydb.cursor()

tablename = input()

with open(f'./csv/{tablename}.csv', 'r') as csv_file:
    csv_reader = csv.DictReader(csv_file)

    table = [line for line in csv_reader]
    for record in table:
        query = """INSERT INTO {} ({}) VALUES ({})""".format(tablename, ",".join(record.keys()), ",".join(f'"{word}"' for word in record.values()))
        # print(query)
        mycursor.execute(query)
        mydb.commit()
