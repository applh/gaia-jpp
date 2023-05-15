import bpy
from mathutils import Vector, Matrix, Euler
import math

def create_cube():
    bpy.ops.mesh.primitive_cube_add()
    return active_object()

def get_active_object():
    return bpy.context.active_object

def active_object():
    return get_active_object()

def ao():
    return get_active_object()

def create_bezier_curve():
    bpy.ops.curve.primitive_bezier_curve_add()
    return active_object()

def translate_vector(vec = Vector(), ref = None):
    objs = make_obj_list(ref)
    for obj in objs:
        obj.location[0] += vec[0]
        obj.location[1] += vec[1]
        obj.location[2] += vec[2]

def make_obj_list(ref):
    if ref is None:
        return [get_object(ref)]
    return get_objects(ref)

def get_object(ref):
    objref = None
    if ref is None:
        objref = ao()
    else:
        if is_string(ref):
            if object_exists(ref):
                objref = bpy.data.objects[ref]
        else:
            objref = ref
    return objref

def get_objects(ref = None):
    objref = []
    if ref is None:
        objref = so()
    else:
        if isinstance(ref, list):
            if len(ref) > 0:
                if isinstance(ref[0], bpy.types.Object):
                    objref = ref
                elif isinstance(ref[0], str):
                    for ob_name in ref:
                        if object_exists(ob_name):
                            objref.append(bpy.data.objects[ob_name])
        elif is_string(ref):
            if object_exists(ref):
                objref.append(bpy.data.objects[ref])
        elif isinstance(ref, bpy.types.Object) :
            objref.append(ref)
    return objref

def object_exists(ref):
    if is_string(ref):
        if ref in bpy.data.objects:
            return True
        else:
            return False
    # redundant but for safety
    else:
        if ref.name in bpy.data.objects:
            return True
        else:
            return False

def rotate_vector(vec = Vector(), ref = None):
    objs = make_obj_list(ref)
    for obj in objs:
        obj.rotation_euler[0] += vec[0] # math.radians(vec[0])
        obj.rotation_euler[1] += vec[1] # math.radians(vec[1])
        obj.rotation_euler[2] += vec[2] # math.radians(vec[2])

def get_object(ref):
    objref = None
    if ref is None:
        objref = ao()
    else:
        if is_string(ref):
            if object_exists(ref):
                objref = bpy.data.objects[ref]
        else:
            objref = ref
    return objref

def create_collection(name):
    if not collection_exists(name):
        bpy.data.collections.new(name)
        colref = bpy.data.collections[name]
        bpy.context.scene.collection.children.link(colref)
        return colref
    return False

def collection_exists(col):
    if is_string(col):
        return col in bpy.data.collections
    return col.name in bpy.data.collections

def link_object_to_collection(ref, col):
    if is_string(col):
        objref = get_object(ref)
        bpy.data.collections[col].objects.link(objref)
    else:
        # Check for bad return argument
        if isinstance(col, bool)!=True:
            objref = get_object(ref)
            col.objects.link(objref)

def is_string(ref):
    if isinstance(ref, str):
        return True
    else:
        return False

def move_objects_to_collection(ref, col):
    objs = get_objects(ref)
    colref = None
    if is_string(col):
        colref = get_collection(col)
    else:
        colref = col
    for o in objs:
        for c in o.users_collection:
            c.objects.unlink(o)
        link_object_to_collection(o, colref)

def get_collection(ref = None):
    if ref is None:
        return bpy.context.view_layer.active_layer_collection.collection
    else:
        if is_string(ref):
            if ref in bpy.data.collections:
                return bpy.data.collections[ref]
            else:
                return False
        else:
            return ref

def scale(ref = None, scale = None):
    objref = get_object(ref)
    if scale is not None:
        objref.scale = Vector((scale[0],scale[1],scale[2]))
    else:
        return objref.scale

def get_material(matname = None):
    if matname is None:
        active = ao()
        if len(active.material_slots) > 0:
            return active.material_slots[0].material
    else:
        for m in bpy.data.materials:
            if m.name == matname:
                return m

def add_material_to_object(ref, mat):
    objref = None
    matref = None
    if is_string(ref):
        objref = get_object(ref)
    else:
        objref = ref
    
    if is_string(mat):
        matref = get_material(mat)
    else:
        matref = mat

    if matref is not None:
        objref.data.materials.append(matref)

def create_plane():
    bpy.ops.mesh.primitive_plane_add()
    return active_object()

# create_cube()

bc = create_collection("branch")
global nb_branch_max
global nb_branch, z_max
global dx
global dy
global dz
global ds

global scale_min 

nb_branch_max = 40
nb_branch = 0
z_max = 0.5

dx = 2
dy = 2
dz = 0.1
ds = 0.8
theta0 = 10

scale_min = 0.8

global matr, matg, matb

matr = get_material("red")
matg = get_material("green")
matb = get_material("blue")

# https://docs.blender.org/api/current/mathutils.html#mathutils.Euler
eul = Euler((0.0, 0.0, 0.0), 'XYZ')
vec = Vector((2.0, 0.0, 0.0))


def create_branch (vect, rot, mat):
    global z_max, nb_branch, dx, dy, dz
    nb_branch += 1
    if (nb_branch > nb_branch_max):
        return
    x = vect[0]
    y = vect[1]
    z = vect[2]
    if (z > z_max):
        return
    
    print("branch", nb_branch, rot, z, y, z)
    
    branch = create_plane()
    
    # scale(branch, [ 0.5, 0.5, 1])
    branch.scale = Vector((0.5, 0.5, 1))
    
    rotate_vector([rot.x, rot.y, rot.z], branch)
    
    vect2 = Vector((vect[0], vect[1], vect[2]))
    vect2.rotate(rot)
    
    slow = 0.6
    x2 = x + slow * vect2[0]
    y2 = y + slow * vect2[1]
    z2 = z + 0.1
    translate_vector([x2, y2, z2 ], branch)
    add_material_to_object(branch, mat)
    move_objects_to_collection(branch, "branch")
    
    # recursive
    create_branch([ x2, y2, z2], rot, mat)
    
def create_tree ():
    global eul
    eul.rotate_axis('Z', math.radians(10.0))
    vec.rotate(eul)
    create_branch(vec, eul, matr)

    eul.rotate_axis('Z', math.radians(10.0))
    vec.rotate(eul)
    create_branch(vec, eul, matg)

    # warning: relative cumulated ?!
    eul.rotate_axis('Z', math.radians(10.0))
    vec.rotate(eul)
    create_branch(vec, eul, matb)

    
create_tree()
