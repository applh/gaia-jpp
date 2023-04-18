import bpy
import sys
import os

# change frame_end to 100
# bpy.context.scene.frame_end = 100

# get the path of this script
script_path = os.path.dirname(os.path.abspath(__file__))

# create a log file to store the output
log_file = os.path.join(script_path, 'my-render.log')

# open the log file
with open(log_file, 'w') as f:
    # write the path to the blend file
    f.write(script_path)


