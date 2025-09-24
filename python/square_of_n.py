n=int(input("Enter a number: "))
l=[]
for i in range(1, n + 1):
    l.append(i * i)
print("The squares of numbers from 1 to", n, "are:", l)