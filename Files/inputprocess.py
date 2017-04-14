# -*- coding: utf-8 -*-
"""
Created on Fri Feb 10 16:26:39 2017

@author: Design
"""

import sys,os
import re

datafile = "dataset.txt"
parentdir = os.path.split(__file__)[0]
outfolder = os.path.join(parentdir, "AllFiles")
if not os.path.exists(outfolder):
    os.mkdir(outfolder)

if os.path.exists(datafile):
    f = open(datafile)
else:
    print "not find datafile:"+datafile
    raise NameError
    
content = f.read().strip().decode('utf-8')
contents = re.split(r'\n\n',content)

for i in xrange(1, len(contents)):
    print i
    m = re.match(u'(时间.*\n问题: )(.*)(\n回答: )(.*)', contents[i], re.S)
    if m:
        ques = m.group(2).replace('\n',' ')#.encode('gb18030')
        answer = m.group(4).replace('\n',' ')#.encode('gb18030')
        towrite = (u"问题："+ques+u'\n采纳回答：'+answer).encode('gb18030')
        with open(os.path.join(outfolder, u'案例%d.txt'%i), 'w') as out_file:
            out_file.write(towrite)
    else:
        #print i, contents[i]
        pass
    