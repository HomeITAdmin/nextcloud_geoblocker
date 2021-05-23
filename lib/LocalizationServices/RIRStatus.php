<?php

namespace OCA\GeoBlocker\LocalizationServices;

abstract class RIRStatus {
	public const kDbNotInitialized = 0;
	public const kDbInitilazing = 1;
	public const kDbError = 2;
	public const kDbOk = 3;
	public const kDbUpdating = 4;
	public const kDbOkButError = 5;
}
