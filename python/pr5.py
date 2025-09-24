#prompt the user for a list of integers.For all vlues greater than 100, store 'over' instead of the actual value. Print the resulting list.
l=input("Enter a list of integers separated by spaces: ").split()
result=[]
for i in l:
    if int(i)>100:
        result.append('over')
    else:
        result.append(int(i))
print(result)
        