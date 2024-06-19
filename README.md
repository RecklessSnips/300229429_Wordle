# CSI 3140 Assignment 2

## Purpose

This is for assignment 2 Wordle.

## About Wordle

Wordle is a popular game developed by software engineer Josh Wardle. Wiki: https://en.wikipedia.org/wiki/Wordle

---

# If the picture not shown, go to the directory: doc/design_system/Game.pdf

# Game States

## Initial State

The game will have 3 sections: a `Give Up` button to give up and check the answer; the game board; and the lifes left.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.54.57 PM.png" style="zoom:30%;" />

## Not enough inputs

If player enter less than 5 characters, a toast will pop up to warn the player

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.55.14 PM.png" style="zoom:30%;" />

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.55.33 PM.png" style="zoom:30%;" />

## Checking State

If the player enter 5 characters and click `enter`, the board will show if each of the character matches the answer

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.55.42 PM.png" style="zoom:30%;" />

## Final State

If the player win the game, a ocngratulation Toast will pop up, and restart the game after 3 seconds.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.56.44 PM.png" style="zoom:30%;" />

If the player wastes all the life, an error Toast will pop up, and will restart the game

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.57.24 PM.png" style="zoom:30%;" />

## Give Up

If the player click the `Give Up` button, it will show the correct answer and restart the game immediately.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-06-18 at 9.57.30 PM.png" style="zoom:30%;" />

---

## Run Project

### 1. CLone the repository to local

### 2. Run the following command

```sh
npm install
```

### 3. Run the command to run project and follow the instructions

(Or go to the localhost with port: 5173: http://localhost:5173)

```sh
npm run dev
```
