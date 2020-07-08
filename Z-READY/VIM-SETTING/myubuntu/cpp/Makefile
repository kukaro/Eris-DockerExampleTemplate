#Makefile
CC = g++
OBJS = main.o
TARGET = exec

all : $(TARGET)

$(TARGET) : $(OBJS)
	$(CC) -o $@ $(OBJS)
	rm $(OBJS)
clean :
	rm -rf $(OBJS) $(TARGET)