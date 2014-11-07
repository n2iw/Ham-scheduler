#!/usr/bin/env python

import sys, os

def switch(dest):
    if dest == '1':
        print "switch to db: 1 "
        os.system("cp includes/constants1.php includes/constants.php")
        os.system("cp includes/database1.php includes/database.php")
    elif dest == '2':
        print "switch to db: 2 "
        os.system("cp includes/constants2.php includes/constants.php")
        os.system("cp includes/database2.php includes/database.php")
    else:
        print "Invalid parameter, only 1 or 2 are allowed"

if __name__ == '__main__':
    if len(sys.argv) != 2:
        print 'Usage: switchdb.py 1/2'
        exit(1)
    switch(sys.argv[1])
