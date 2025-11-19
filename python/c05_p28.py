import csv
csv_path = r"C:\Users\rixij\OneDrive\Desktop\aj\python\data.csv"
with open(csv_path, newline='', encoding="utf-8") as f:
    reader = csv.reader(f)
    for row in reader:
        print(row)