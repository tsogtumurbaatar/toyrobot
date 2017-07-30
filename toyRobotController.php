<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ToyRobot;
use File;

class toyRobotController extends Controller
{
	
	private $toyRobot;

	public function __construct(ToyRobot $toyRobotInjection)
	{
		$this->toyRobot = $toyRobotInjection;
	}


	public function deleteSession(Request $request)
	{
		if($request->session()->has('toyRobotInstance'))
			$request->session()->forget('toyRobotInstance');
	}

	public function pushText(Request $request)
	{
		
		$incoming_command = $request['command_text'];

		$return_text = "";
		
		if($request->session()->has('toyRobotInstance'))
		{
			$this->toyRobot =  $request->session()->get('toyRobotInstance');

			if(!strcmp(substr($incoming_command,0,5),'place'))
			{
				$return_text = $this->toyRobot->place(substr($incoming_command,6,1),substr($incoming_command,8,1),substr($incoming_command,10));
				if(!strcmp($return_text ,'1'))
					$return_text = "";
			}
			elseif(!strcmp($incoming_command,'move'))
				$return_text = $this->toyRobot->move();
			elseif(!strcmp($incoming_command,'left'))
				$this->toyRobot->left();
			elseif(!strcmp($incoming_command,'right'))
				$this->toyRobot->right();
			elseif(!strcmp($incoming_command,'report'))
				$return_text = $this->toyRobot->report();
			else $return_text = "Command not found";

			$request->session()->put('toyRobotInstance', $this->toyRobot);
		}
		else
		{
			if(!strcmp(substr($incoming_command,0,5),'place'))
				{$return_text = $this->toyRobot->place(substr($incoming_command,6,1),substr($incoming_command,8,1),substr($incoming_command,10));
					if(!strcmp($return_text ,'1'))
					{
						$request->session()->put('toyRobotInstance', $this->toyRobot);
						$return_text = "";
					}

				}
				else
					$return_text = "The first valid command to the robot is a PLACE command";
			}
			return \Response::json($return_text);
		}

		public function fileupload(Request $request)
		{

			if (!$request->hasFile('txtfile')) {
				return back()->with('failure','No file to upload!!!');
			}
			
			$fileName = time().'.'.$request->txtfile->getClientOriginalExtension();
			$request->txtfile->move(public_path('txtfiles'), $fileName);		

			try
			{
				$file_contents = File::get(public_path('txtfiles').'/'.$fileName);
				$remove = "\r\n";
				$file_contents = explode($remove, $file_contents);
				

			}
			catch (Illuminate\Filesystem\FileNotFoundException $exception)
			{
				die("The file doesn't exist");
			}

			return view("toyrobot", [
				'file_contents'=>$file_contents
				]);

		}





	}
