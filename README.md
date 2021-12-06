

# Modzy Smart Call Center Solution - MSCCS
MSCCS is an AI solution for call center audio processing - Revamping call center with Modzy Artificial Intelligence.


---

#### Table of Content

- [ Code Structure ](#installation)
- [ Features and Description ](#usp)
- [ Demo Link ](#demo)


---


&nbsp;&nbsp;
<a name="installation"></a>
### Project Code Structure Overview

Since the project is built with Laravel framework, most of the code structure explanation can refer to the Laravel documentation. I will only highlight important code files and folders.

- app/Jobs/ProcessAudio : This is the main core file for asynchronously processing the post-call data. Which using dynamic job technique and split the job process into multiple stage to avoid timeout issues.
- app/Services/Modzy : This is the main service file that process all the Modzy AI queries with CURL.
- bootstrap/app : This is the main file that select the env file based on the domain name.
- config/system : This folder contain all the system configuration variable.



&nbsp;&nbsp;
<a name="usp"></a>
### Project Features and Description
Refer to https://devpost.com/software/modzy-smart-call-center-solution for more details.


&nbsp;&nbsp;
<a name="demo"></a>
### Demo Link
Project URL : https://msccs.xyz

