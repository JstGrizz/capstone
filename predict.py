#!/usr/bin/env python3
import sys
import json
from pathlib import Path

import torch
from torch import nn
from torchvision.models import vit_b_16, ViT_B_16_Weights
from PIL import Image
from collections import OrderedDict

# ─── Configuration: adjust only if you rename these folders/files ────────────
ROOT       = Path(__file__).parent
MODEL_PATH = ROOT / "best_model.pth"
# your folders of class-subdirectories (e.g. ROOT/"Original Images"/"Original Images")
CLASSES_DIR = ROOT / "Original Images" / "Original Images"
# ────────────────────────────────────────────────────────────────────────────────

# Device selection
device = "cuda" if torch.cuda.is_available() else "cpu"

def load_label_maps(classes_dir: Path):
    # each subfolder name is a class
    classes = sorted([d.name for d in classes_dir.iterdir() if d.is_dir()])
    label2idx = {c:i for i,c in enumerate(classes)}
    idx2label = {i:c for c,i in label2idx.items()}
    return idx2label

def load_model(model_path: Path, num_classes: int):
    ckpt = torch.load(model_path, map_location=device)
    model = vit_b_16(weights=None)
    # replace head with same output size
    model.heads = nn.Sequential(OrderedDict([
        ("head", nn.Linear(768, num_classes))
    ]))
    model.load_state_dict(ckpt["model"])
    model.to(device).eval()
    return model

def predict_image(image_path: Path, model, transforms, idx2label):
    img = Image.open(image_path).convert("RGB")
    tensor = transforms(img).unsqueeze(0).to(device)
    with torch.inference_mode():
        logits = model(tensor)
        probs  = torch.softmax(logits, dim=1)
        idx    = int(probs.argmax(dim=1))
    return idx2label[idx]

def main():
    # 1) Arg check
    if len(sys.argv) != 2:
        print(json.dumps({"error": "Usage: predict.py <path_to_image>"}))
        sys.exit(1)

    img_path = Path(sys.argv[1])
    if not img_path.is_file():
        print(json.dumps({"error": f"Image not found: {img_path}"}))
        sys.exit(1)

    # 2) Build label map & model
    idx2label = load_label_maps(CLASSES_DIR)
    model     = load_model(MODEL_PATH, len(idx2label))

    # 3) Prepare transforms (must match your training)
    weights    = ViT_B_16_Weights.DEFAULT
    transforms = weights.transforms()

    # 4) Predict
    try:
        label = predict_image(img_path, model, transforms, idx2label)
        result = {"src": str(img_path), "hasil": label}
    except Exception as e:
        result = {"src": str(img_path), "hasil": f"Error: {e}"}

    # 5) Emit JSON
    print(json.dumps(result))


if __name__ == "__main__":
    main()
