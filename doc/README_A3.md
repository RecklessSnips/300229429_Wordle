# Assignment 3

------

This file document the Wordle game updtes with php and Ajax.

# Overview

------

We used php to build a top 5 best score board, which will use `$_SESSION` array to store the best 5 attempts to solve the Wordle game. (We choose 5 since Wordle is different from the game Yatzy). And a global variable `attempts` to keep track the total number of attempts of user, when a user win the wordle, the attempts will increase by one, and decrease by 1 if the player loses all the chances.

## Ajax

We use the axis to call perform the Ajax functions, the details are in the comment of the code.

```javascript
import axios from 'axios'

// Create a object to send the ajax request to my php server
const apiClient = axios.create({
  baseURL: 'http://localhost:8080',
  // Include the cookies, 
  withCredentials: true,
  // Format is json
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

export default {
  // Get the $_SESSION array from the player.php, to get all the user attempts
  getMessage() {
    return apiClient.get('/player.php')
  },
  // Put new attempts of a player into the $_SESSION array
  sendMessage(player) {
    return apiClient.post('/player.php', player)
  },
  // Close and destroy the $_SESSION array, to refresh the score board
  destroySession() {
    return apiClient.get('/quit.php')
  },
  // To update the global variable attempts into the $_SESSION array
  postAttempts(attempts) {
    apiClient.post('/attempts.php', JSON.stringify({ attempts }))
  },
  // Get the global variable attempts from $_SESSION array
  getAttempts() {
    return apiClient.get('/attempts.php')
  },
  // Check if a word matches the answer
  checkWord(word) {
    return apiClient.post('/checkWord.php', word)
  },
  // Get a random word
  getWord() {
    return apiClient.get('/word.php')
  }
}
```



## Global Variable: `Attempts`

This variable is aim to track the total number of attempts the player since the game starts. SInce it's stored in the `$_SESSION` array, when u refresh the page, it will not be reset to 0.

We update the variable when the user either win or lose a game:

```javascript
const handleKeydown = async (event: KeyboardEvent) => {
  ...
  // Pass the variable to the attempts.php
  api.postAttempts(php_attempts.value++)
	...
}
```

### attempts.php

```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents("php://input");
	  // Get the updated variable's value
    $data = json_decode($json, true);

  	// Initialize Attempt_Number if not already set
    if (!isset($_SESSION["Attempt_Number"])) {
        $_SESSION["Attempt_Number"] = 1;
    }
  
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        die(json_encode(["error" => "Invalid JSON: " . json_last_error_msg()]));
    }
    
    if (isset($data["attempts"] )) {
	      // Update the variable
        $_SESSION["Attempt_Number"] += $data["attempts"];
    }

} elseif ($_SERVER["REQUEST_METHOD"] === "GET"){
    echo json_encode($_SESSION);
}
```

## Scoreboard

In the `player.php` we store a object:

```javascript
let player = {
  // Global variable
  a_number: php_attempts.value,
  // How many times player has tried
  a_attempts: 7 - life.value
}
```

into the session. In the method handleKeyDown, we pass this object to the player.php:

```javascript
// Sending the input word to the php server
const word = inputWord.value[currentRow.value].join('')
/* 
Sends the word, correct answer, row and column information to the checkWord.php,
which will return the game state: (win, lose, continue), and the index array to
display the correct color of the div.
*/
const response = await api.checkWord({
  word,
  answer: answer.value,
  currentRow: currentRow.value,
  currentCol: currentCol.value
})
// Updates the index array
index.value = response.data.index
// Update the div color
evaluateBoard()
// If user's word is correct
if (response.data.result === 'win') {
  congrats()
  let player = {
    a_number: php_attempts.value,
    a_attempts: 7 - life.value
  }
  // Sends the current attempt number and attempts
  api.sendMessage(player)
  // Update the total attempt number (global variable)
  api.postAttempts(1)
  setTimeout(() => {
    resetBoard()
    resetRowCol()
    fetchMessage()
  }, 3000)
} else if (response.data.result === 'lose') {
  // Lost, waste one life
  lose()
  api.postAttempts(1)
  setTimeout(() => {
    resetBoard()
    resetRowCol()
    fetchMessage()
    life.value = 6
  }, 3000)
} else {
  // Go to the next line
  popUp()
  currentRow.value++
  currentCol.value = 0
  life.value--
  index.value = response.data.index
}
}
```

In the checkWord.php:

```php
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        die(json_encode(["error" => "Invalid JSON: " . json_last_error_msg()]));
    }
		
    if (isset($data['word']) && isset($data['answer']) && isset($data['currentRow']) && 							                         																			isset($data['currentCol'])) {
      	// Get the word, answer, row, and col.
        $word = strtoupper($data['word']);
        $answer = strtoupper($data['answer']);
        $currentRow = $data['currentRow'];
        $currentCol = $data['currentCol'];
	      // Initialize the index array with -1
        $index = array_fill(0, 5, -1);
        // Check the word if match
        for ($i = 0; $i < strlen($word); $i++) {
            if ($word[$i] === $answer[$i]) {
                $index[$i] = 1;
            } elseif (strpos($answer, $word[$i]) !== false) {
                $index[$i] = 0;
            }
        }
				// Win
        if ($word === $answer) {
            echo json_encode(["result" => "win", "index" => $index]);
        } 
	      // Lose
      	elseif ($data['currentRow'] >= 5) {
            echo json_encode(["result" => "lose", "index" => $index]);
        } 
      	// Continue
      	else {
            echo json_encode(["result" => "continue", "index" => $index]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields"]);
    }
}else {
    echo json_encode(["error" => "Life not set"]);
}
?>
```

In the player.php:

```php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents("php://input");
  	// Get the player object
    $data = json_decode($json, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        die(json_encode(["error" => "Invalid JSON: " . json_last_error_msg()]));
    }

    if (isset($data['a_number']) && isset($data['a_attempts'])) {
      	// Store the number of attempts and the sucess attempts into new variables
        $attempt_number = $data['a_number'];
        $attempts = $data['a_attempts'];
      	// Put into the $_SESSION array
        $_SESSION["Attempt_$attempt_number"] = $attempts;
        // Return this array (optional)
        $response = ["Attempt " . $attempt_number => $_SESSION["Attempt_$attempt_number"]];
        echo json_encode($response);

    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
  	// Get the $_SESSION array
    echo json_encode($_SESSION);
}
```

Lastly, we will retrieve the both the global variable and the player attempts from the session:

```javascript
async function fetchMessage() {
  try {
    const session = await api.getMessage()
    const session_object = session.data
    console.log(session_object)
    const tbody = document.getElementsByTagName('tbody')[0]
    // Filter out 'Attempt_Number' and then sort the attempts in ascending order
    const session_array = Object.entries(session_object)
      .filter((player) => player[0] !== 'Attempt_Number' && player[0] !== 'answer')
      .sort((a, b) => a[1] - b[1])

    // Only keep the top 5 attempts
    const top_5 = session_array.slice(0, 5)

    top_5.forEach((player) => {
      if (player[0] == 'Attempt_Number' || player[0] == 'answer') {
        return
      }
      // Create the table elements
      const tr = document.createElement('tr')
      const td_key = document.createElement('td')
      const td_value = document.createElement('td')

      td_key.innerText = player[0].substring(8)
      td_value.innerText = player[1]

      tr.appendChild(td_key)
      tr.appendChild(td_value)

      tbody.appendChild(tr)
    })
  } catch (error) {
    console.error('Error fetching message:', error)
  }
}
```

## Get Random Words

We have a `word.php` to generate a random word

```php
<?php
...

$words = [
  'apple', 'about', 'above', 'actor', 'acute', 'adopt', 'asain', 'aside', 'avoid', 'aware',
  'baker', 'bland', 'blunt', 'broad', 'brush', 'brief', 'bread', 'break', 'broke', 'below',
  'carry', 'catch', 'cause', 'cedar', 'chant', 'claim', 'class', 'climb', 'clear', 'cendy',
  'dance', 'dandy', 'death', 'debit', 'decoy', 'depth', 'delay', 'daddy', 'dirty', 'doubt',
  'eagle', 'early', 'earth', 'easel', 'eject', 'ethic', 'equal', 'event', 'every', 'exact',
  'fable', 'facet', 'faith', 'fancy', 'feast', 'floor', 'first', 'final', 'flame', 'floor'
];

...

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $random_word = $words[array_rand($words)];
    $_SESSION['answer'] = $random_word;
    echo json_encode(["answer" => $_SESSION['answer']]);
}
?>
```

We call this in our JS:

```javascript
const fetchWord = async () => {
  try {
    const response = await api.getWord()
    answer.value = response.data.answer
  } catch (error) {
    console.error('Error fetching word:', error)
  }
}
```



## Clean Scoreboard

We also include a button to clean the session, so the player can refresh their score board!

```php
<?php
// Start
session_start();
...

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Unset first
    session_unset();
    // Destroy the session
    session_destroy();
}
echo json_encode(["status" => "All session variables destroied"]);
?>
```

## Button

```javascript
function destroy() {
  // Use the api object to call the method
  api.destroySession()
}
```

## Api

```javascript
import axios from 'axios'

const apiClient = axios.create({
  baseURL: 'http://localhost:8080',
  withCredentials: true,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

export default {
	...
  // Method to destroy the session
  destroySession() {
    return apiClient.get('/quit.php')
  }
  ...
}
```

# State of the game

------

## 1 Initial State

Run the following command to start the game

![](/Users/Ahsoka/Desktop/Screenshot 2024-07-10 at 3.49.21 PM.png)

Run this to start the php server

![](/Users/Ahsoka/Desktop/Screenshot 2024-07-10 at 3.50.03 PM.png)

The game should look like

(The view Wordle(from assignment 2) and Wordle_V2 are exactly the same, but using different server. Wordle use the JS to compute the logic, but Wordle_V2 use Php. So Wordle is just a **old** **version**)

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.49.13 PM.png" style="zoom:50%;" />

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.50.00 PM.png" style="zoom:50%;" />

## 2 Playing

Now start our first trial

You can see on the terminal, the correct answer is: broke, and we have used 4 lives, if we enter the correct answer in the 5th line, then our attempt number is 1(1st round), and the attempts is 5.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.53.03 PM.png" style="zoom:50%;" />

Lets check out scoreboard, you can see the table has been updated, the Attempt number indicates n-th round of player's result, and the right column is the number of attempts player used.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.53.45 PM.png" style="zoom:50%;" />

Let's play again, now attempt number is 2 since we are in our 2nd round. And we are try to enter the correct answer in the first try!

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.54.56 PM.png" style="zoom:50%;" />

Now on the scoreboard, the table will display the 2nd try **first** since it has a lower(better) attempts.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.55.24 PM.png" style="zoom:50%;" />

Of course, if you enter a wrong answer, it will prompt you:

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.56.11 PM.png" style="zoom:50%;" />

Or not enough characters:

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.56.28 PM.png" style="zoom:50%;" />

And, if you waste all the lives, the total attempt number will increase, but will not stored into the score board
<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.57.33 PM.png" style="zoom:50%;" />

As can be seen, there's no record for <u>attempt number 5</u>:

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.58.55 PM.png" style="zoom:50%;" />

## 3 Keep playing

Lets keep try a few time, and see the results.

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 4.59.54 PM.png" style="zoom:50%;" />

As the table shows, no matter how many attempts we try, it will only store the top 5 scores!

## 4 Clean Board

If you want to challenge yourself again, you can press the `clean board` button

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 5.00.33 PM.png" style="zoom:50%;" />

After a few seconds:

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 5.00.44 PM.png" style="zoom:50%;" />

The board is clean! Lets go back to the game:

<img src="/Users/Ahsoka/Desktop/Screenshot 2024-07-11 at 5.01.15 PM.png" style="zoom:50%;" />

The Attempt has been reset to 1, that means the button works!
