string = input("enter a string: ")
length = len(string)
if length > 1:
    string = string[-1] + string[1:-1] + string[0]
print("swapped string:", string)