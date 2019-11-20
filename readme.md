## About Paravel
Paravel is a project about creating a Web Api to automatically generate parallel code from sequential code.

To generate parallel code, is used third dependencies frameworks to analyze parallel dependencies and false dependencies, after that the code is anotated.

Anotating a code specifies loops that can be iterated parallely, variables that must be created and other false dependencies that must be removed to increase parallel granularity.

The anotated code can be parallelized with a parallel compiler that will generate the parallel code.

## Roadmap
All roadmap steps must be implemented with independent api calls.
~~* Anotate C and C++ sequential code with [DawnCC]~~(https://github.com/gleisonsdm/DawnCC-Compiler).
~~* Generate CUDA and OpenCL code from C anotated code with [PPCG]~~(https://github.com/Meinersbur/ppcg).
~~* Compile and run CUDA and OpenCL code.~~
* Integrate anotated and parallelized code with a FTP server.
* Integrate with a database and create user authentication.

## Requirements
To run CUDA code is necessary a NVIDIA GPU with CUDA support.

To run OpenCL code is necessary a NVIDIA or AMD GPU.

## License
The Paravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
