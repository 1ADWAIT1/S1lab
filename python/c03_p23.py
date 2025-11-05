import turtle
t=turtle.Turtle()
t.speed(0)
t.pensize(2)
turtle.bgcolor("navy")
colors=["red","orange","yellow","green","blue","purple","pink","white"]
for i in range(360):
    t.color(colors[i%8])
    t.circle(100)
    t.right(10)
turtle.done()