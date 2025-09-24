nums = []
print("enter numbers and type 'done' when finished:")
while True:
    entry = input()
    if entry.lower() == 'done':
        break
    try:                                
        nums.append(int(entry))
    except ValueError:
        print("Invalid input. Please enter a number or 'done'.")
print("numbers in the list:",nums)
pos_nums = [num for num in nums if num > 0]
print("positive numbers in the list:", pos_nums)

