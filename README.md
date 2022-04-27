# C3PO - Discord Bot

C-3PO is a humanoid robot character in the Star Wars programmed for etiquette and protocol.
And here he will not be much different, he will be responsible for some protocols, such as reminders and birthdays of the day.

### Commands
```
$remindme {once} {frequency} message 
```
|Parameters|Required?|Options|Description|
|---|---|---|---|
|`$remindme`  | `true` | | Start reminder| 
|`{frequency}` | `true` | `once` and `repeat` | Use `once` for reminders that will run only once and `repeat` for reminders that will run in a routine  |
|`{when}` | `true` | `01s`, `01m`, `01h`, `01d` and `Y-m-d_H:i:s`  | This parameter supports two formats, the first is any number followed by its time unit. The second is a formatted date. |
|`message` | `true` | | Description to your reminder |

### Examples
```
$remindme {once} {2022-04-22_08:00:00} Send email with report sales
$remindme {once} {01h} Meeting with my friends
$remindme {once} {30m} Drink some coffee
$remindme {repeat} {07d} Hello future me
```

### Features
| Description |Implemented?
|---|---|
| Create Reminder | `Yes` |
| List Reminders | `Not Yet` |
| Remove Reminder | `Not Yet` |
| Create Birthday | `Not Yet` |
| List Birthdays | `Not Yet` |
| Remove Birthday | `Not Yet` |