#!/usr/bin/env python3
"""Generates the seasonal reward sets (icon.png, add.gif, remove.gif) in images/.

Usage: python3 tools/make_seasonal_icons.py   (requires Pillow)
"""
import math, os, random
from PIL import Image, ImageDraw

S = 4            # supersampling factor
ICON = 256       # icon canvas (px, final)
W, H = 400, 300  # animation frame size (px, final)
OUT = os.path.join(os.path.dirname(os.path.abspath(__file__)), '..', 'images')


def canvas(size=ICON):
    im = Image.new('RGBA', (size * S, size * S), (0, 0, 0, 0))
    return im, ImageDraw.Draw(im)


def box(cx, cy, rx, ry):
    return [(cx - rx) * S, (cy - ry) * S, (cx + rx) * S, (cy + ry) * S]


def poly(pts):
    return [(x * S, y * S) for x, y in pts]


def finish(im, size=ICON):
    return im.resize((size, size), Image.LANCZOS)


# ---------------------------------------------------------------- icons
def pumpkin():
    im, d = canvas()
    dark, mid, light = (214, 90, 10), (255, 125, 20), (255, 160, 50)
    for cx, rx in ((78, 52), (178, 52), (100, 62), (156, 62)):
        d.ellipse(box(cx, 150, rx, 84), fill=dark)
    d.ellipse(box(128, 150, 58, 88), fill=mid)
    d.ellipse(box(128, 150, 30, 86), fill=light)
    d.polygon(poly([(116, 66), (124, 30), (146, 22), (150, 34), (138, 42), (140, 66)]), fill=(70, 120, 30))
    d.arc(box(86, 80, 30, 24), 200, 300, fill=(60, 160, 60), width=5 * S)
    glow = (255, 225, 80)
    d.polygon(poly([(82, 120), (110, 120), (96, 94)]), fill=(70, 30, 5))
    d.polygon(poly([(146, 120), (174, 120), (160, 94)]), fill=(70, 30, 5))
    d.polygon(poly([(122, 136), (134, 136), (128, 148)]), fill=(70, 30, 5))
    d.polygon(poly([(78, 164), (100, 180), (116, 168), (128, 184), (140, 168), (156, 180), (178, 164),
                    (170, 196), (150, 206), (128, 198), (106, 206), (86, 196)]), fill=(70, 30, 5))
    d.polygon(poly([(100, 176), (112, 172), (112, 184)]), fill=glow)
    d.polygon(poly([(144, 172), (156, 176), (144, 184)]), fill=glow)
    return finish(im)


def ghost():
    im, d = canvas()
    out, body = (170, 190, 235), (250, 250, 255)
    def shape(fill, grow):
        g = grow
        d.ellipse(box(128, 100, 70 + g, 70 + g), fill=fill)
        d.rectangle([(58 - g) * S, 100 * S, (198 + g) * S, (200 + g) * S], fill=fill)
        for i in range(4):
            d.ellipse(box(58 + 14 + i * 35, 200, 17 + g, 17 + g), fill=fill)
    shape(out, 6)
    shape(body, 0)
    d.ellipse(box(104, 98, 11, 16), fill=(30, 30, 60))
    d.ellipse(box(152, 98, 11, 16), fill=(30, 30, 60))
    d.ellipse(box(108, 92, 4, 4), fill=(255, 255, 255))
    d.ellipse(box(156, 92, 4, 4), fill=(255, 255, 255))
    d.ellipse(box(128, 140, 14, 18), fill=(30, 30, 60))
    d.ellipse(box(80, 128, 11, 7), fill=(255, 170, 190))
    d.ellipse(box(176, 128, 11, 7), fill=(255, 170, 190))
    return finish(im)


def tree():
    im, d = canvas()
    d.rectangle(box(128, 222, 16, 20), fill=(120, 75, 35))
    for top, hw, bot, col in ((40, 52, 110, (30, 130, 60)), (76, 70, 160, (36, 150, 70)),
                              (112, 88, 214, (44, 170, 80))):
        d.polygon(poly([(128, top), (128 - hw, bot), (128 + hw, bot)]), fill=col)
    star = [(128 + (r) * math.sin(a * math.pi / 5), 38 - r * math.cos(a * math.pi / 5) + 0)
            for a, r in ((i, 22 if i % 2 == 0 else 9) for i in range(10))]
    d.polygon(poly(star), fill=(255, 215, 40), outline=(230, 160, 0))
    for (x, y, c) in ((110, 100, (230, 40, 50)), (150, 130, (60, 120, 240)), (96, 168, (255, 200, 40)),
                      (138, 184, (230, 40, 50)), (170, 200, (240, 120, 200)), (82, 206, (60, 120, 240)),
                      (118, 142, (255, 200, 40))):
        d.ellipse(box(x, y, 9, 9), fill=c)
        d.ellipse(box(x - 3, y - 3, 3, 3), fill=(255, 255, 255))
    return finish(im)


def snowman():
    im, d = canvas()
    ol = (150, 175, 215)
    for cy, r in ((190, 56), (118, 42)):
        d.ellipse(box(128, cy, r + 4, r + 4), fill=ol)
        d.ellipse(box(128, cy, r, r), fill=(252, 252, 255))
    # scarf
    d.rounded_rectangle([88 * S, 146 * S, 168 * S, 162 * S], 6 * S, fill=(215, 40, 50))
    d.rounded_rectangle([140 * S, 150 * S, 158 * S, 196 * S], 6 * S, fill=(190, 30, 40))
    # hat
    d.rectangle([84 * S, 70 * S, 172 * S, 80 * S], fill=(35, 35, 45))
    d.rectangle([100 * S, 28 * S, 156 * S, 74 * S], fill=(35, 35, 45))
    d.rectangle([100 * S, 56 * S, 156 * S, 66 * S], fill=(200, 40, 50))
    # face
    d.ellipse(box(114, 108, 5, 5), fill=(20, 20, 30))
    d.ellipse(box(142, 108, 5, 5), fill=(20, 20, 30))
    d.polygon(poly([(124, 118), (124, 128), (160, 124)]), fill=(255, 140, 30))
    for a in range(-2, 3):
        d.ellipse(box(128 + a * 7, 134 + abs(a) * -1 + 2 * (a * a) / 4, 2.5, 2.5), fill=(30, 30, 40))
    for y in (180, 200, 218):
        d.ellipse(box(128, y, 5, 5), fill=(30, 30, 40))
    # arms
    d.line([(76 * S, 184 * S), (36 * S, 150 * S)], fill=(110, 70, 35), width=5 * S)
    d.line([(180 * S, 184 * S), (220 * S, 150 * S)], fill=(110, 70, 35), width=5 * S)
    return finish(im)


def egg(pattern=0):
    im, d = canvas()
    c = box(128, 138, 76, 100)
    d.ellipse([c[0] - 5 * S, c[1] - 5 * S, c[2] + 5 * S, c[3] + 5 * S], fill=(150, 90, 170))
    d.ellipse(c, fill=(250, 205, 235))
    mask = Image.new('L', im.size, 0)
    ImageDraw.Draw(mask).ellipse(c, fill=255)
    layer = Image.new('RGBA', im.size, (0, 0, 0, 0))
    ld = ImageDraw.Draw(layer)
    ld.rectangle([0, 96 * S, 256 * S, 116 * S], fill=(120, 200, 250))
    zig = [(x * 1.0, 148 + (14 if (i % 2) else -2)) for i, x in enumerate(range(40, 230, 20))]
    ld.line(poly(zig), fill=(255, 220, 70), width=12 * S, joint='curve')
    ld.rectangle([0, 176 * S, 256 * S, 190 * S], fill=(140, 220, 150))
    for x in range(60, 210, 30):
        ld.ellipse(box(x, 214 if (x // 30) % 2 else 204, 6, 6), fill=(255, 120, 150))
    for x in range(75, 200, 40):
        ld.ellipse(box(x, 70, 6, 6), fill=(255, 255, 255))
    im.paste(layer, (0, 0), Image.composite(layer.getchannel('A'), Image.new('L', im.size, 0), mask))
    d.ellipse(box(100, 78, 14, 24), fill=(255, 255, 255, 0))  # no-op keep shape
    hl = Image.new('RGBA', im.size, (0, 0, 0, 0))
    ImageDraw.Draw(hl).ellipse(box(98, 80, 10, 22), fill=(255, 255, 255, 80))
    im.alpha_composite(hl)
    return finish(im)


def bunny():
    im, d = canvas()
    fur, ol, pink = (252, 250, 250), (180, 170, 200), (255, 175, 200)
    for g, col in ((5, ol), (0, fur)):
        d.ellipse(box(92, 62, 20 + g, 56 + g), fill=col)
        d.ellipse(box(164, 62, 20 + g, 56 + g), fill=col)
        d.ellipse(box(128, 150, 72 + g, 66 + g), fill=col)
    d.ellipse(box(92, 66, 10, 40), fill=pink)
    d.ellipse(box(164, 66, 10, 40), fill=pink)
    d.ellipse(box(104, 138, 9, 12), fill=(40, 30, 60))
    d.ellipse(box(152, 138, 9, 12), fill=(40, 30, 60))
    d.ellipse(box(107, 133, 3, 3), fill=(255, 255, 255))
    d.ellipse(box(155, 133, 3, 3), fill=(255, 255, 255))
    d.ellipse(box(128, 158, 9, 6), fill=pink)
    d.line([(128 * S, 164 * S), (128 * S, 174 * S)], fill=(120, 90, 110), width=2 * S)
    d.arc(box(116, 174, 12, 9), 0, 180, fill=(120, 90, 110), width=2 * S)
    d.arc(box(140, 174, 12, 9), 0, 180, fill=(120, 90, 110), width=2 * S)
    d.ellipse(box(76, 160, 12, 8), fill=(255, 190, 205))
    d.ellipse(box(180, 160, 12, 8), fill=(255, 190, 205))
    for dy in (-4, 4):
        d.line([(40 * S, (160 + dy) * S), (84 * S, (166 + dy / 2) * S)], fill=(190, 180, 200), width=2 * S)
        d.line([(216 * S, (160 + dy) * S), (172 * S, (166 + dy / 2) * S)], fill=(190, 180, 200), width=2 * S)
    return finish(im)


# ------------------------------------------------------------ particles
def spark(d, x, y, r, col):
    pts = []
    for i in range(8):
        a = i * math.pi / 4
        rr = r if i % 2 == 0 else r * 0.3
        pts.append((x + rr * math.cos(a), y + rr * math.sin(a)))
    d.polygon(poly(pts), fill=col)


def snowflake(d, x, y, r, col):
    for i in range(3):
        a = i * math.pi / 3
        d.line([(x - r * math.cos(a)) * S, (y - r * math.sin(a)) * S, (x + r * math.cos(a)) * S,
                (y + r * math.sin(a)) * S], fill=col, width=max(1, int(r / 4 * S)))


def bat(d, x, y, r, col):
    d.ellipse(box(x, y, r * .3, r * .35), fill=col)
    for sgn in (-1, 1):
        d.polygon(poly([(x, y - r * .1), (x + sgn * r, y - r * .5), (x + sgn * r * .8, y + r * .05),
                        (x + sgn * r * .5, y - r * .1), (x + sgn * r * .3, y + r * .3)]), fill=col)


def confetti(d, x, y, r, col):
    d.ellipse(box(x, y, r * .6, r * .6), fill=col)


def candy(d, x, y, r, col):
    d.ellipse(box(x, y, r * .6, r * .6), fill=col)
    d.polygon(poly([(x - r, y - r * .5), (x - r * .5, y), (x - r, y + r * .5)]), fill=col)
    d.polygon(poly([(x + r, y - r * .5), (x + r * .5, y), (x + r, y + r * .5)]), fill=col)


THEMES = {
    'halloween-pumpkins': dict(draw=pumpkin, shape=bat, cols=[(40, 30, 60), (110, 60, 160), (255, 140, 20)], spark=(255, 200, 40)),
    'halloween-ghosts': dict(draw=ghost, shape=spark, cols=[(255, 255, 255), (170, 255, 200), (190, 150, 255)], spark=(200, 255, 220)),
    'christmas-trees': dict(draw=tree, shape=snowflake, cols=[(255, 255, 255), (170, 210, 255), (255, 215, 60)], spark=(255, 230, 80)),
    'christmas-snowmen': dict(draw=snowman, shape=snowflake, cols=[(255, 255, 255), (190, 225, 255), (255, 80, 90)], spark=(180, 225, 255)),
    'easter-eggs': dict(draw=egg, shape=confetti, cols=[(255, 150, 190), (130, 210, 250), (255, 225, 90), (150, 225, 150)], spark=(255, 255, 255)),
    'easter-bunnies': dict(draw=bunny, shape=candy, cols=[(255, 150, 190), (130, 210, 250), (255, 225, 90), (190, 150, 255)], spark=(255, 255, 255)),
}


# ------------------------------------------------------------- animation
def ease_out_back(t):
    c1 = 1.70158
    return 1 + (c1 + 1) * (t - 1) ** 3 + c1 * (t - 1) ** 2


def frame_image(icon, scale, angle, cx, cy, particles, theme, t):
    im = Image.new('RGBA', (W * S, H * S), (0, 0, 0, 0))
    d = ImageDraw.Draw(im)
    for p in particles:
        x, y, r, col, kind = p(t)
        if r > 0.5:
            (spark if kind == 'spark' else theme['shape'])(d, x, y, r, col)
    if scale > 0.02:
        size = max(2, int(210 * scale * S))
        ic = icon.resize((size, size), Image.LANCZOS)
        if angle:
            ic = ic.rotate(angle, resample=Image.BICUBIC, expand=True)
        im.alpha_composite(ic, (int(cx * S - ic.width / 2), int(cy * S - ic.height / 2))) if (
            0 <= cx * S - ic.width / 2 and 0 <= cy * S - ic.height / 2) else im.paste(
            ic, (int(cx * S - ic.width / 2), int(cy * S - ic.height / 2)), ic)
    return im.resize((W, H), Image.LANCZOS)


def to_gif_frame(rgba):
    key = (255, 0, 255)
    a = rgba.getchannel('A').point(lambda v: 255 if v >= 128 else 0)
    bg = Image.new('RGB', rgba.size, key)
    bg.paste(rgba.convert('RGB'), (0, 0), a)
    p = bg.quantize(colors=255, method=Image.MEDIANCUT, dither=Image.NONE)
    pal = p.getpalette()
    # find a free slot 255 for transparency
    pal[255 * 3:255 * 3 + 3] = list(key)
    p.putpalette(pal)
    px = p.load()
    am = a.load()
    for y in range(rgba.height):
        for x in range(rgba.width):
            if am[x, y] == 0:
                px[x, y] = 255
    p.info['transparency'] = 255
    return p


def save_gif(frames, path, dur):
    ims = [to_gif_frame(f) for f in frames]
    ims[0].save(path, save_all=True, append_images=ims[1:], duration=dur, loop=0,
                transparency=255, disposal=2, optimize=False)


def build(name, th, seed):
    rnd = random.Random(seed)
    icon = th['draw']()
    folder = os.path.join(OUT, name)
    os.makedirs(folder, exist_ok=True)
    icon.save(os.path.join(folder, 'icon.png'), optimize=True)
    cx, cy = W / 2, H / 2 + 6

    # ---- add: pop in with overshoot, wiggle, burst of particles
    burst = []
    for i in range(16):
        ang = rnd.uniform(0, 2 * math.pi)
        dist = rnd.uniform(110, 190)
        r = rnd.uniform(11, 20)
        col = rnd.choice(th['cols'])
        kind = 'spark' if i % 3 == 0 else 'shape'
        start = rnd.uniform(0.1, 0.4)
        sc = th['spark'] if kind == 'spark' else col
        def p(t, ang=ang, dist=dist, r=r, sc=sc, kind=kind, start=start):
            u = (t - start) / (1 - start)
            if u <= 0:
                return 0, 0, 0, sc, kind
            e = 1 - (1 - u) ** 2
            return (cx + math.cos(ang) * dist * e * 1.3, cy + math.sin(ang) * dist * e - 20 * u,
                    r * (1 - u * .6) * (1 if u < .85 else (1 - u) / .15), sc, kind)
        burst.append(p)
    n = 30
    frames = []
    for i in range(n):
        t = i / (n - 1)
        if t < 0.45:
            u = t / 0.45
            sc, ang = ease_out_back(u), (1 - u) * 360 * 0.5
            y = cy - (1 - u) * 20
        else:
            u = (t - 0.45) / 0.55
            sc = 1 + 0.04 * math.sin(u * math.pi * 4) * (1 - u)
            ang = 8 * math.sin(u * math.pi * 4) * (1 - u)
            y = cy - 6 * abs(math.sin(u * math.pi * 2)) * (1 - u)
        frames.append(frame_image(icon, sc, ang, cx, y, burst, th, t))
    # hold the final pose a little
    frames += [frames[-1]] * 6
    save_gif(frames, os.path.join(folder, 'add.gif'), 60)

    # ---- remove: shake, then shrink-spin-fall; dull particles drift down
    fall = []
    for i in range(12):
        x0 = rnd.uniform(cx - 90, cx + 90)
        y0 = rnd.uniform(cy - 60, cy + 20)
        r = rnd.uniform(9, 14)
        gray = rnd.randint(130, 180)
        start = rnd.uniform(0.25, 0.6)
        drift = rnd.uniform(-30, 30)
        def p(t, x0=x0, y0=y0, r=r, gray=gray, start=start, drift=drift):
            u = (t - start) / (1 - start)
            if u <= 0:
                return 0, 0, 0, (gray,) * 3, 'shape'
            return (x0 + drift * u, y0 + 150 * u * u, r * (1 - u * .8), (gray, gray, gray + 20), 'shape')
        fall.append(p)
    frames = []
    for i in range(n):
        t = i / (n - 1)
        if t < 0.3:
            u = t / 0.3
            sc, ang, x, y = 1, 0, cx + 10 * math.sin(u * math.pi * 6) * (0.4 + u), cy
        else:
            u = (t - 0.3) / 0.7
            sc = max(0, 1 - u ** 1.5)
            ang = -u * 540
            x, y = cx, cy + 120 * u * u
        frames.append(frame_image(icon, sc, ang, x, y, fall, th, t))
    frames += [frames[-1]] * 2
    save_gif(frames, os.path.join(folder, 'remove.gif'), 60)
    print('built', name)


if __name__ == '__main__':
    for i, (name, th) in enumerate(THEMES.items()):
        build(name, th, 100 + i)
