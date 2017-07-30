## Toy Robot Simulator - <a href="http://rotelearn.net/toyrobot" target="_blank">http://rotelearn.net/toyrobot</a>

The application is a simulation of a toy robot moving on a square tabletop, of dimensions 5 units x 5 units.
- There are no other obstructions on the table surface.
- The robot is free to roam around the surface of the table, but must be prevented from falling to destruction. Any movement that would result in the robot falling from the table must be prevented, however further valid movement commands must still be allowed.

## Used Programming tools

In here I used the following tools, frameworks
- Laravel, as a Backend, from Backend I generated JSON object, and communicated with FrontEnd
- AngularJS, as a FrontEnd
- Bootstrap template, allows to view in multiply device screens without breaking

In here, I tried to implement Command pattern (Design pattern) in the application. I have created toyRobot concrete class, and there I defined the following methods: place, move, left, right, report. Every method has its own functionality and features, and I included input checking features in every methods as well. In controller, I created instance of toyRobot class, and to keep that instance alive I used session, the user input the commands from keyboard or file, system checks that command is valid or not, if command is valid system run correspondent method of the toyRobot class. And sends JSON object to View file, in View file AngularJS works here so it shows the result in the view without page refreshing. If you want to see the working version of this repository you can go to <a href="http://rotelearn.net/toyrobot" target="_blank">http://rotelearn.net/toyrobot</a>. And in the last, all commands are case sensitive, only lower-case commands are accepted.   

## Here are the some screen shots and evidence of system is working 
<p align="center">
<img src="http://rotelearn.net/txtfiles/1.png"><br>
<img src="http://rotelearn.net/txtfiles/2.png"><br>
<img src="http://rotelearn.net/txtfiles/3.png"><br>
<img src="http://rotelearn.net/txtfiles/4.png"><br>
</p>
