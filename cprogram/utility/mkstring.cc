#include <stdio.h>
#include <string.h>
#include <stdlib.h>
void mkstring(const char *str1, const char *str2, char *&newstr){

/* Concatenation of strings require memory allocation */

    newstr = (char *)malloc( (strlen(str1) + strlen(str2) + 1)*sizeof(char)   );

    strcpy(newstr, str1);
    strcat(newstr, str2);
}

