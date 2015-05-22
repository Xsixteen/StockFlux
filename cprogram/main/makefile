#
# Define macros
complier = c++
flags    = -O2 
libdir =../utility
# Define directories
dir1 = ../preprocessing
dir2 = ../solver
dir3 = ../sorting
dir4 = ../alignment
dir19= ../writing
dir20 = ../test
# Define macros that consists of all object files for the program.
objs=./main.o $(dir1)/*.o $(dir4)/*.o
#
# Make the exicutable file called run using recursive make.
#
run:  main.o preprocessing_obj alignment_obj
	$(complier) $(flags) -o $@ $(objs) -L$(libdir) -lmylib -lm
#
preprocessing_obj:
	cd $(dir1); make all
#
alignment_obj:
	cd $(dir4); make all
#
solver_obj:
	cd $(dir2); make all
#
sorting_obj:
	cd $(dir3); make all
#
writing_obj:
	cd $(dir19); make all
#
test_obj:
	cd $(dir20); make all
#
main.o: main.cc
	$(complier) $(flags) -c main.cc 
#
# A utility to clean up unsuccessful compilation, not frequently used.
clean: 
	rm -f ../*/*.o  run
#
#      EOF
