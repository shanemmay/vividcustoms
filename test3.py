import urllib2
import os 
dir_path = os.path.dirname(os.path.realpath(__file__))
with open(dir_path + "test2.png", 'w') as f:
    f.write(urllib2.urlopen(dir_path).read());