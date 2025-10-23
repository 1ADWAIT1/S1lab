import pygame
import sys
import random

pygame.init()

WIDTH, HEIGHT = 800, 400
screen = pygame.display.set_mode((WIDTH, HEIGHT))
pygame.display.set_caption("Side-Scrolling Runner")

# Colors
WHITE = (255, 255, 255)
GROUND_COLOR = (100, 200, 100)
BLACK = (0, 0, 0)

# Load images
rest_right = pygame.image.load("rest.png").convert_alpha()
run_right = pygame.image.load("running.png").convert_alpha()
jump_right = pygame.image.load("jump_right.png").convert_alpha()
obstacle_img = pygame.image.load("obstruction.gif").convert_alpha()

# Resize images
def scale_img(img, width, height):
    return pygame.transform.scale(img, (width, height))

CHAR_WIDTH, CHAR_HEIGHT = 80, 100
OBSTACLE_WIDTH, OBSTACLE_HEIGHT = 50, 70

rest_right = scale_img(rest_right, CHAR_WIDTH, CHAR_HEIGHT)
run_right = scale_img(run_right, CHAR_WIDTH, CHAR_HEIGHT)
jump_right = scale_img(jump_right, CHAR_WIDTH, CHAR_HEIGHT)
obstacle_img = scale_img(obstacle_img, OBSTACLE_WIDTH, OBSTACLE_HEIGHT)

# Character fixed X pos (center-ish)
char_x = 150
char_y = HEIGHT - CHAR_HEIGHT - 50  # 50 is ground height

# Movement vars
velocity_y = 0
gravity = 0.8
is_jumping = False
speed = 7  # speed of obstacles moving left

# Ground rectangle
ground_rect = pygame.Rect(0, HEIGHT - 50, WIDTH, 50)

# Obstacles list: each is a dict with x, rect
obstacles = []
OBSTACLE_GAP = 300  # Minimum distance between obstacles

# Font for text
font = pygame.font.SysFont(None, 48)

# Game states
game_over = False

clock = pygame.time.Clock()

def create_obstacle(last_x):
    # Create an obstacle at least OBSTACLE_GAP pixels after last_x or screen end
    x_pos = last_x + random.randint(OBSTACLE_GAP, OBSTACLE_GAP + 200)
    y_pos = HEIGHT - OBSTACLE_HEIGHT - 50  # On ground
    rect = pygame.Rect(x_pos, y_pos, OBSTACLE_WIDTH, OBSTACLE_HEIGHT)
    return {"x": x_pos, "rect": rect}

# Start with 3 obstacles spread out
last_obstacle_x = WIDTH
for _ in range(3):
    obs = create_obstacle(last_obstacle_x)
    obstacles.append(obs)
    last_obstacle_x = obs["x"]

def draw_text(text, x, y):
    img = font.render(text, True, BLACK)
    screen.blit(img, (x, y))

while True:
    screen.fill(WHITE)
    pygame.draw.rect(screen, GROUND_COLOR, ground_rect)

    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            pygame.quit()
            sys.exit()
        if game_over and event.type == pygame.KEYDOWN:
            if event.key == pygame.K_r:
                # Reset game
                obstacles.clear()
                last_obstacle_x = WIDTH
                for _ in range(3):
                    obs = create_obstacle(last_obstacle_x)
                    obstacles.append(obs)
                    last_obstacle_x = obs["x"]
                is_jumping = False
                velocity_y = 0
                char_y = HEIGHT - CHAR_HEIGHT - 50
                game_over = False

    keys = pygame.key.get_pressed()
    if not game_over:
        # Jumping
        if not is_jumping and keys[pygame.K_SPACE]:
            is_jumping = True
            velocity_y = -15

        if is_jumping:
            velocity_y += gravity
            char_y += velocity_y
            if char_y >= HEIGHT - CHAR_HEIGHT - 50:
                char_y = HEIGHT - CHAR_HEIGHT - 50
                is_jumping = False
                velocity_y = 0

        # Move obstacles left
        for obs in obstacles:
            obs["x"] -= speed
            obs["rect"].x = obs["x"]

        # Remove obstacles off screen and add new ones
        if obstacles and obstacles[0]["x"] < -OBSTACLE_WIDTH:
            obstacles.pop(0)
            new_obs = create_obstacle(obstacles[-1]["x"] if obstacles else WIDTH)
            obstacles.append(new_obs)

        # Collision detection (simple rect collision)
        char_rect = pygame.Rect(char_x, char_y, CHAR_WIDTH, CHAR_HEIGHT)
        for obs in obstacles:
            if char_rect.colliderect(obs["rect"]):
                game_over = True

        # Draw character image
        if is_jumping:
            char_img = jump_right
        else:
            char_img = run_right
        screen.blit(char_img, (char_x, char_y))
    else:
        # Game over screen
        draw_text("Game Over! Press R to Retry", WIDTH//4, HEIGHT//2)

    # Draw obstacles
    for obs in obstacles:
        screen.blit(obstacle_img, (obs["x"], obs["rect"].y))

    pygame.display.flip()
    clock.tick(60)
