string=str(input("Enter a string: "))
l=[]
for i in string:
    if i in ("aeiouAEIOU"):
        l.append(i)
print("Vowels in the string are: ",l)