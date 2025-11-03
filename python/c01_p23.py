import matplotlib.pyplot as plt
import numpy as np
x = np.linspace(0, 2 * np.pi, 100)
y1 = np.sin(x)
y2 = np.cos(x)
plt.plot(x, y1, label='Sine', color='blue')
plt.plot(x, y2, label='Cosine', color='red')
plt.title("Sine and Cosine Waves")
plt.xlabel("X values (radians)")
plt.ylabel("Y values")
plt.legend()
plt.show()