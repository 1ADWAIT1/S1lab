import csv
csv_path = r"C:\Users\rixij\OneDrive\Desktop\aj\python\data.csv"
columns_to_read = ["Name", "Age"]
with open(csv_path, newline='', encoding="utf-8") as f:
    reader = csv.DictReader(f)
    for row in reader:
        selected = [row[col] for col in columns_to_read]
        print(selected)