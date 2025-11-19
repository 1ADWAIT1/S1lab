with open(r"C:\Users\rixij\OneDrive\Desktop\aj\python\source.txt", "r") as src, \
     open(r"C:\Users\rixij\OneDrive\Desktop\aj\python\output.txt", "w") as dst:
    for line_number, line in enumerate(src, start=1):
        if line_number % 2 == 1:
            dst.write(line)
print("Odd-numbered lines have been copied to output.txt")