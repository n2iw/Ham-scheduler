#!/usr/bin/env python
import os
import sys

if len(sys.argv) >= 2:
    tempFolder = sys.argv[1];
else:
    tempFolder = "w1aw-schedule"

if len(sys.argv) == 3:
    orgFolder = sys.argv[2]
else:
    orgFolder = "~/Sites/rdxa/"

outputFolder = os.getenv("HOME") + "/Downloads"
os.chdir(outputFolder)


print "Copying files"
os.system("cp -R %s ./%s/" %(orgFolder, tempFolder));

print "Removing Git files"
os.system("rm -rf ./%s/.git" % tempFolder);
os.system("rm -f ./%s/.gitignore" % tempFolder);

print "Removing .DS_Store files"
os.system("rm -f ./%s/.DS_Store" % tempFolder);
os.system("rm -f ./%s/css/.DS_Store" % tempFolder);
os.system("rm -f ./%s/includes/.DS_Store" % tempFolder);
os.system("rm -f ./%s/templates/.DS_Store" % tempFolder);
os.system("rm -f ./%s/js/.DS_Store" % tempFolder);

print "Removing files shouldn't included"
os.system("rm -f ./%s/includes/constants.php" % tempFolder);
os.system("rm -f ./%s/includes/constants1.php" % tempFolder);
os.system("rm -f ./%s/includes/constants2.php" % tempFolder);
os.system("rm -f ./%s/includes/database1.php" % tempFolder);
os.system("rm -f ./%s/includes/database2.php" % tempFolder);
os.system("rm -f ./%s/fully-install.php" % tempFolder);
os.system("rm -f ./%s/switchdb.py" % tempFolder);
os.system("rm -f ./%s/distribute.py" % tempFolder);

print "Compressing to %s.tar.gz" % tempFolder 
#os.system("tar cfz %s.tar.gz %s/" % (tempFolder, tempFolder));
os.system("zip -X -r %s.zip %s/*" % (tempFolder, tempFolder));

print "Removing temp files"
os.system("rm -rf ./%s/" % tempFolder);
