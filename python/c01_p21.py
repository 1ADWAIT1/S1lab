string=input("enter a string: ")
if string.endswith("ing"):
    string=string+"ly"
else:
    string=string+"ing"
print("Modified string: ",string)