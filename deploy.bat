xcopy * C:\hpv.olin.edu\html\ /s /d /EXCLUDE:.wdignore
zip -r uploadfile.zip C:/hpv.olin.edu/html/*
rmdir /s /q C:\hpv.olin.edu
scp uploadfile.zip linwebprod:~/
rm uploadfile.zip
ssh linwebprod unzip uploadfile
ssh linwebprod rm uploadfile.zip
ssh linwebprod rm -rf /var/www/virtual/hpv.olin.edu/html/*
ssh linwebprod cp -fR hpv.olin.edu/html/* /var/www/virtual/hpv.olin.edu/html/
ssh linwebprod rm -rf hpv.olin.edu/