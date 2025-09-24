#list ordinal value of each element of a word. use ord() function
word = input("Enter a word: ")
ord_values = [ord(char) for char in word]
print("Ordinal values:", ord_values)
