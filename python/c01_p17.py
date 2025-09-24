l=input("Enter a list of numbers separated by spaces: ").split()
l=[i for i in l if int(i)%2!=0]
print("List of odd numbers:",l)