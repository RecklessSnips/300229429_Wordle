# Design System

------

This document outlines the design system for the Wordle project.

# Fonts

------

## Primary Font: 

### Times New Roman

# Colours

------

## Primary Color:

- ### Black

## Secondary Color:

- ### Gold

- ### Aquamarine

- ### Gray

- ### rgb(255, 200, 1)

- ### rgb(242, 195, 138)

# Wordle

------

## Game State

The Wordle has three states: playing, lost, won. The game will begin with the state playing until the player consumed all six chances. Then the game will either: restart after 3 seconds; or will turn into the lost state and restart the game again (change to the playing state).

## Game structure

We used the framework **Vue** to implement this game. The game board is packed inside a "container" `div` element. The game only have two parts: the header and the actual game board.

### Header

This section keeps the `give up` button which allow player to restart the game at any time, it will show the correct result once click on it. It also has a few components from the UI component library [PrimeVue](https://primevue.org/introduction/). Which is for the pop up window to display the answer, and alos for the pop up toasts, for better player experience.

### Game Board

The actual game board only has a 2D array which dynamically shows player's keyboards input. This is realized by `window.addEventListener('keydown', handleKeydown)` to bind each key stroke onto the array.

### Info

The section `info` is merely to display player's chances left, which is realized by Vue's `{{}}` syntax.

## Game End

When player correctly spell the word or waste all the chances, the game will either pop up a congratulation Toast or will warn the player game lost. Then the game will refresh the game board and enter the playing state again.	