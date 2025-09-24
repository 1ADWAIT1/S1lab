#create a single string from two strings, swapping characters at position 1.
str1=input("Enter first string: ")
str2=input("Enter second string: ")
new_str=str1[0]+str2[1]+str1[2:]+str2[0]+str1[1]+str2[2:]
print("New string is",new_str)
