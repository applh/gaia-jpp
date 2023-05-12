import XpGaia from 'XpGaia'

let template = '#xpc-hud'

let data = {
    ui_grid: true,
    p5_size: 300,
    p5_wmax: 1000,
}

let style_td0 = {
    padding: '0.25vmin',
    cursor: 'pointer',
}

let methods = {
    act_save() {
        console.log('act_save')
    },
    act_mini_all() {
        // set all markers ui_maxi to false
        XpGaia.store0.markers_xpc.forEach((marker) => {
            marker.ui_maxi = false
        })
    },
    act_maxi_all() {
        // set all markers ui_maxi to true
        XpGaia.store0.markers_xpc.forEach((marker) => {
            marker.ui_maxi = true
        })
    },
    style_td(row, col) {
        let style = Object.assign({}, style_td0)
        let r = row * 20
        let g = col * 20
        let b = 10 * (row + col)
        let color = `rgba(${r}, ${g}, ${b}, 0.8)`
        style.backgroundColor = color
        return style
    },
    act_ui_grid() {
    },
    act_td(row, col) {
        let index = 10 * (row - 1) + col - 1
        XpGaia.store0.map_xpc.marker_focus(index)
    },
    act_sketch_size() {
        if (sketch_p5) {
            console.log('act_sketch_size')
            sketch_p5.resizeCanvas(this.p5_size, this.p5_size)
        }
    },
    init_p5() {
        if (window.p5) {
            console.log('init_p5')
            // https://p5js.org/reference/#/p5/p5
            let sketch_config = p => {
                let x = 10
                let y = 10
                let vx = 1
                let vy = 1

                let w = this.p5_size
                let h = this.p5_size
                let img = null

                let theta = 0

                p.setup = function () {
                    console.log('p5.setup')
                    p.createCanvas(w, h)
                    img = p.loadImage('/template/img/photo.jpg')
                }

                p.draw = function () {
                    p.frameRate(20);

                    // WARNING: this is called every frame
                    // console.log('p5.draw')

                    // black background
                    // p.background(0)

                    // transparent background
                    p.clear()

                    p.fill(10)
                    p.rect(x - 4 - 40, y + 4 - 40, 80, 80)
                    // random move rect and wrap around
                    vx += vx * 0.001 * (Math.floor(Math.random() * 100) - 50)
                    vy += vy * 0.001 * (Math.floor(Math.random() * 100) - 50)
                    x = (x + vx + p.width) % p.width
                    y = (y + vy + p.height) % p.height

                    // image
                    p.image(img, x - 40, y - 40, 80, 80)
                    // interaction
                    if (p.mouseIsPressed) {
                        p.fill('rgba(255, 255, 0, 0.50)')
                    }
                    else {
                        p.fill('rgba(0, 255, 0, 0.25)')
                    }
                    p.ellipse(p.mouseX, p.mouseY, 80, 80)

                    if (XpGaia?.vstore?.tree_line_w > 0) {
                        p.tree()
                    }
                }

                p.tree = function () {
                    // tree
                    p.stroke(XpGaia?.vstore?.tree_color ?? 255);
                    p.strokeWeight(XpGaia?.vstore?.tree_line_w ?? 2);
                    // Let's pick an angle 0 to 90 degrees based on the mouse position
                    let a = (p.mouseY / p.height) * 90;
                    // Convert it to radians
                    theta = p.radians(a);
                    // Start the tree from the bottom of the screen
                    p.translate(p.width / 2, p.height);
                    // Draw a line 120 pixels
                    p.line(0, 0, 0, -120);
                    // Move to the end of that line
                    p.translate(0, -120);
                    // Start the recursive branching!
                    p.branch(p.height * 0.25);
                }

                p.branch = function (len) {
                    // Each branch will be 2/3rds the size of the previous one
                    len *= 0.66;

                    // All recursive functions must have an exit condition!!!!
                    // Here, ours is when the length of the branch is 2 pixels or less
                    if (len > 2) {
                        p.push();    // Save the current state of transformation (i.e. where are we now)
                        p.rotate(theta);   // Rotate by theta
                        p.line(0, 0, 0, -len);  // Draw the branch
                        p.translate(0, -len); // Move to the end of the branch
                        p.branch(len);       // Ok, now call myself to draw two new branches!!
                        p.pop();     // Whenever we get back here, we "pop" in order to restore the previous matrix state

                        // Repeat the same thing, only branch off to the "left" this time!
                        p.push();
                        p.rotate(-theta);
                        p.line(0, 0, 0, -len);
                        p.translate(0, -len);
                        p.branch(len);
                        p.pop();
                    }
                }
                // store p5 instance
                sketch_p5 = p
            }

            // WARNING: NOT WORKING ON shadowRoot
            let p5 = new window.p5(sketch_config, 'box-p5')
        }
    }

}

let sketch_p5 = null;


let mounted = function () {
    if (!window.p5) {
        // import /template/p5/p5.js
        // by adding a script tag to the document
        let script = document.createElement('script')
        script.src = '/template/p5/p5.js'

        // CHECK: avoid duplicate script tag ?!
        // add id to script tag
        script.id = 'scriptjs-p5'

        script.onload = () => this.init_p5()
        document.head.appendChild(script)

        // update p5_wmax on window resize
        window.addEventListener('resize', () => {
            this.p5_wmax = XpGaia.vstore.ww
        })
        this.p5_wmax = XpGaia.vstore.ww

    }
}

export default {
    template,
    // WARNING: copy data for each instance
    data: () => Object.assign({}, data),
    methods,
    mounted,
}